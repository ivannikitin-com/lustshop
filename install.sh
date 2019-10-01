#!/bin/bash

wp theme activate lustshop --allow-root
wp plugin install loco-translate --activate --allow-root
wp plugin install cyr2lat --activate --allow-root
wp plugin install woocommerce --activate --allow-root
wp plugin install https://github.com/afragen/github-updater/archive/develop.zip --activate --allow-root