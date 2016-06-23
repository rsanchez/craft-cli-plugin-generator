/* --------------------------------------------------------------------------------
    GENERATOR-CRAFTPLUGIN
    generator-craftplugin is a Yeoman generator for Craft CMS plugins

    Type just `yo craftplugin` and a new Craft CMS plugin template tailored to
    your liking will be created.
-------------------------------------------------------------------------------- */

'use strict';

/* --------------------------------------------------------------------------------
    *** Begin configuration section ***
-------------------------------------------------------------------------------- */

const API_QUESTIONS = [
        {
            type: "list",
            name: 'apiVersion',
            message: 'Select what Craft CMS API to target:',
            choices: [
            ],
            store: true
        },
    ];

const TARGET_APIS_DIR = "/target_apis";

var apis = {};

/* --------------------------------------------------------------------------------
    *** End configuration section ***
-------------------------------------------------------------------------------- */

var yo              = require('yeoman-generator');
var chalk           = require('chalk');
var fs              = require('fs');
var child_process   = require('child_process');
var path            = require('path');
var optionOrPrompt  = require('yeoman-option-or-prompt');
var handlebars      = require('yeoman-handlebars-engine');

module.exports = yo.generators.Base.extend({

    _optionOrPrompt: optionOrPrompt,

/* -- initializing --  Your initialization methods (checking current project state, getting configs, etc) */

    initializing: function() {
        this.log(chalk.yellow.bold('[ Initializing ]'));
        var done = this.async();

        this.engine = handlebars;
        this.answers = {};
        this.askApiVersion = true;

/* -- Load in our API JSON configs */

        path = this.sourceRoot() + TARGET_APIS_DIR;
        fs.readdirSync(path).forEach(function(file, index) {
            var curPath = path + "/" + file;
            if (!fs.statSync(curPath).isDirectory()) {
                var ext = file.substr(file.lastIndexOf('.') + 1);
                if (ext == 'json') {
                    var data = fs.readFileSync(curPath);
                    var obj = JSON.parse(data);
/* -- Fill in the API_QUESTIONS with the found target APIs */
                    apis[obj.API_KEY] = obj;
                    API_QUESTIONS[0].choices.push({key: obj.API_KEY, name: obj.API_NAME, value: obj.API_KEY});
                    }
                }
            });

/* -- Ask them which API version they want */

        if (this.askApiVersion) {
            this._optionOrPrompt(API_QUESTIONS, function(answers) {
                this.api = apis[answers.apiVersion];
/* -- Change the templates root based on the API version */
                this.sourceRoot(this.sourceRoot() + "/" + this.api.API_KEY);
                done();
                }.bind(this));
            }
        },

/* -- prompting -- Where you prompt users for options (where you'd call this.prompt()) */

    prompting: function() {
        this.log(chalk.yellow.bold('[ Prompting ]'));
        var done = this.async();

/* -- Turn the pluginComponents into an array */

        if (this.options.pluginComponents) {
            this.options.pluginComponents = this.options.pluginComponents.split(',');
            }

/* -- Change any questions with "when" properties into functions */

        for (var i = 0; i < this.api.QUESTIONS.length; i++) {
            if (this.api.QUESTIONS[i].hasOwnProperty('when')) {
                    var whatsRequired = this.api.QUESTIONS[i].when;
                    this.api.QUESTIONS[i].when = newClosure(whatsRequired);
                }
            }
/* -- Ask some questions about how they want the plugin customized */

        this._optionOrPrompt(this.api.QUESTIONS, function(answers) {
            var now = new Date();

            this.answers = answers;
            this.answers.templatesDir = 'templates';
            this.answers.pluginDirName = this.answers.pluginName.directorize();
            this.answers.pluginCamelHandle = this.answers.pluginName.camelize();
            this.answers.pluginHandle = this.answers.pluginCamelHandle.capitalizeFirstLetter();

/* -- Auto-fill some variables we'll be using in our templates */

            this.answers.dateNow = now.toISOString();
            this.answers.niceDate = now.yyyymmdd();

            this.answers.copyrightNotice = "Copyright (c) " + now.getFullYear() + " " + this.answers.pluginAuthorName;
            this.answers.pluginDownloadUrl = "???";
            this.answers.pluginDocsUrl = "???";
            this.answers.pluginReleasesUrl = "???";
            this.answers.pluginCloneUrl = "???";
            if (this.answers.pluginAuthorGithub) {
                this.answers.pluginDownloadUrl = "https://github.com/" + this.answers.pluginAuthorGithub + "/" + this.answers.pluginDirName + "/archive/master.zip";
                this.answers.pluginDocsUrl = "https://github.com/" + this.answers.pluginAuthorGithub + "/" + this.answers.pluginDirName + "/blob/master/README.md";
                this.answers.pluginReleasesUrl = "https://raw.githubusercontent.com/" + this.answers.pluginAuthorGithub + "/" + this.answers.pluginDirName + "/master/releases.json";
                this.answers.pluginCloneUrl = "https://github.com/" + this.answers.pluginAuthorGithub + "/" + this.answers.pluginDirName + ".git";
                }

/* -- Clean up the various handle names, and convert them to arrays */

            var subPrefixHandles = ["controllerName", "elementName", "fieldName", "modelName", "purchasableName", "recordName", "serviceName", "taskName", "widgetName"];
            var _this = this;

            subPrefixHandles.forEach(function(subElement) {
                if (typeof _this.answers[subElement] != 'undefined') {
                    _this.answers[subElement] = _this.answers[subElement].split(',');
                    _this.answers[subElement].forEach(function(nameElement, nameIndex, nameArray) {
                        nameArray[nameIndex] = nameElement.prefixize();
                        });
                    }
                });

            done();
            }.bind(this));
        },

/* -- configuring -- Saving configurations and configure the project (creating .editorconfig files and other metadata files) */

    configuring: function() {
        this.log(chalk.yellow.bold('[ Configuring ]'));
        this.log(this.answers);

/* -- Create the destination folder */

        var dir = this.answers.pluginDirName;
        this.log('+ Creating Craft plugin folder ' + chalk.green(dir));
        if (!fs.existsSync(dir)){
            fs.mkdirSync(dir);
            }
        this.destDir = dir + '/';
        },

/* -- writing -- Where you write the generator specific files (routes, controllers, etc) */

    writing: function() {
        this.log(chalk.yellow.bold('[ Writing ]'));

this.log(this.answers);

/* -- Write template files */

        this.log(chalk.green('> Writing template files'));
        for (var i = 0; i < this.api.TEMPLATE_FILES.length; i++) {
            var file = this.api.TEMPLATE_FILES[i];
            var destFile;
            var skip = false;

            if ((typeof file.requires == 'object') && (file.requires.length)) {
                var _this = this;
                file.requires.forEach(function(thisRequires, index) {
                    if (_this.answers.pluginComponents.indexOf(thisRequires) == -1) {
                        skip = true;
                        }
                    });
                }
            if (!skip) {
                if (file.prefix) {
/* -- Handle templates that get prefixed */
                    if (file.subPrefix) {
/* -- Handle templates that have a prefix and a sub-prefix */
                        var subPrefix = this.answers[file.subPrefix];
                        var _this = this;
                        subPrefix.forEach(function(thisPrefix, index) {
                            destFile = _this.destDir + file.destDir + _this.answers.pluginHandle + thisPrefix + file.dest;
                            _this.log('+ ' + _this.answers.templatesDir + "/" + file.src + ' wrote to ' + chalk.green(destFile));
                            _this.answers['index'] = index;
                            _this.fs.copyTpl(
                                _this.templatePath(file.src),
                                _this.destinationPath(destFile),
                                _this.answers
                                );
                            });
                        } else {
/* -- Handle templates that only have a prefix */
                        destFile = this.destDir + file.destDir + this.answers.pluginHandle  + file.dest;
                        this.log('+ ' + this.answers.templatesDir + "/" + file.src + ' wrote to ' + chalk.green(destFile));
                        this.answers['index'] = 0;
                        this.fs.copyTpl(
                            this.templatePath(file.src),
                            this.destinationPath(destFile),
                            this.answers
                            );
                        }
                    } else {
/* -- Handle templates that are not prefixed */
                    destFile = this.destDir + file.destDir + file.dest;
                    this.log('+ ' + this.answers.templatesDir + "/" + file.src + ' wrote to ' + chalk.green(destFile));
                    this.answers['index'] = 0;
                    this.fs.copyTpl(
                        this.templatePath(file.src),
                        this.destinationPath(destFile),
                        this.answers
                        );
                    }
                }
            }

/* -- Copy boilerplate files */

        this.log(chalk.green('> Copying boilerplate files'));
        for (var i = 0; i < this.api.BOILERPLATE_FILES.length; i++) {
            var file = this.api.BOILERPLATE_FILES[i];
            var destFile = this.destDir + file.src;
            var skip = false;
            if ((typeof file.requires == 'object') && (file.requires.length)) {
                var _this = this;
                file.requires.forEach(function(thisRequires, index) {
                    if (_this.answers.pluginComponents.indexOf(thisRequires) == -1) {
                        skip = true;
                        }
                    });
                }
                if (!skip) {
                this.log('+ ' + this.answers.templatesDir + "/" + file.src + ' copied to ' + chalk.green(destFile));
                this.fs.copy(
                    this.templatePath(file.src),
                    this.destinationPath(destFile)
                    );
                }
            }


        this.log(chalk.green('> Sync to file system'));
        },

/* -- install -- Where installation are run (npm, bower) */

    install: function() {
        this.log(chalk.yellow.bold('[ Install ]'));

        },

/* -- end - Called last, cleanup, say good bye, etc */

    end: function() {
        this.log(chalk.yellow.bold('[ End ]'));

/* -- Craft base plugins */

        this.log(chalk.green('> End install commands'));
        for (var i = 0; i < this.api.END_INSTALL_COMMANDS.length; i++) {
            var command = this.api.END_INSTALL_COMMANDS[i];
            this.log('+ ' + chalk.green(command.name) + ' executed');
            child_process.execSync(command.command);
        }

        this.log("Your Craft CMS plugin " + chalk.green(this.answers.pluginHandle) + " has been created.");
        this.log('The default LICENSE.txt is the ' + chalk.green('MIT license') +  '; feel free to change it as you see fit.');
        this.log(chalk.green('> All set.  Have a nice day.'));
        },

});

// Create a closure to wrap up our local scope
function newClosure(whatsRequired) {
    // Local variables that end up within closure
    var whichWhen = whatsRequired;
    return function(answers) {
                return (typeof answers.pluginComponents != 'object') ? false : (answers.pluginComponents.indexOf(whichWhen) != -1);
                };
}

// Return a date in YYYY.MM.DD format
Date.prototype.yyyymmdd = function() {
   //Grab each of your components
   var yyyy = this.getFullYear().toString();
   var MM = (this.getMonth()+1).toString();
   var dd  = this.getDate().toString();

   //Returns your formatted result
  return yyyy + '.' + (MM[1]?MM:"0"+MM[0]) + '.' + (dd[1]?dd:"0"+dd[0]);
};

// Return a string stripped of non-alpha characters, and replace spaces with _'s
String.prototype.directorize = function() {
    return this.toLowerCase().replace(/\W/g, '');
}

// Return a string stripped of white space & non-alpha characters, and in CamelCase (lowercasing it first, if it has any whitespace in it)
String.prototype.camelize = function() {
    var _this = this;
    if (/\s/.test(_this)) {
       _this = _this.toLowerCase();
    }
    return _this.replace(/[^a-z0-9 ]/ig, '').replace(/(?:^\w|[A-Z]|\b\w|\s+)/g, function(match, index) {
        if (+match === 0) return ""; // or if (/\s+/.test(match)) for white spaces
        return index == 0 ? match.toLowerCase() : match.toUpperCase();
    });
}

// Convert a string to have proceed with a _ and be camel-cased, with the first letter capitalized
String.prototype.prefixize = function() {
    if (this == "")
        return this;
    else
        return ("_" + this.camelize().capitalizeFirstLetter());
}

// Capitalize the first letter of a string
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

// Mimic PHP's in_array()
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}