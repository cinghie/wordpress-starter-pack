#!/bin/bash

PLUGIN_FOLDER='yith-woocommerce-multi-step-checkout-premium'
PLUGIN_NAME='YITH WooCommerce Multi-step Checkout Premium'

# Exit if any command fails.
set -e

# Change to the expected directory.
cd "$(dirname "$0")"
cd ..

# Enable nicer messaging for build status.
BLUE_BOLD='\033[1;34m';
GREEN_BOLD='\033[1;32m';
RED_BOLD='\033[1;31m';
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';
error () {
	echo -e "\n${RED_BOLD}$1${COLOR_RESET}\n"
}
status () {
	echo -e "\n${BLUE_BOLD}$1${COLOR_RESET}\n"
}
success () {
	echo -e "\n${GREEN_BOLD}$1${COLOR_RESET}\n"
}
warning () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

clear_temp () {
    if [[ -e "/tmp/${PLUGIN_FOLDER}" ]]; then
	    rm -rf /tmp/${PLUGIN_FOLDER}
    fi

    if [[ -e "/tmp/${PLUGIN_FOLDER}.zip" ]]; then
	    rm /tmp/${PLUGIN_FOLDER}.zip
    fi

}

status "=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=."
status "It's the time to release ${PLUGIN_NAME}!"
status "=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=.=."

# Plugin Framework update
status "Plugin Framework and Upgrade updating..."
git submodule update --init --recursive && git submodule foreach --recursive git pull origin master

# Run build.
status "Build: uglify JS, generate POT and download translations..."
npm run build

# Generate the plugin zip file.
status "Creating archive... 🎁"

clear_temp;

mkdir /tmp/${PLUGIN_FOLDER}

cp -r -t /tmp/${PLUGIN_FOLDER} \
	assets/ \
	includes/ \
	languages/ \
	plugin-fw/ \
	plugin-options/ \
	plugin-upgrade/ \
	templates/ \
	init.php \
	README.txt \
	LICENSE.txt \
	wpml-config.xml \

EXCLUDED_FILES='*/Gruntfile.js */package.json */package-lock.json'

( cd /tmp && zip -r -q ./${PLUGIN_FOLDER}.zip ./${PLUGIN_FOLDER} -x */.\* ${EXCLUDED_FILES} )
cp /tmp/${PLUGIN_FOLDER}.zip ../${PLUGIN_FOLDER}.zip

clear_temp;

success "Done. You've built ${PLUGIN_NAME}! 🎉"