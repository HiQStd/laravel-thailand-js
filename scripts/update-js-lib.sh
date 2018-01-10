#!/bin/bash

echo "Updating jquery.Thailand.js"
git submodule update --remote

echo "Copying jquery.Thailand.js library into the project"
cp ./jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js ./libraries/jquery.Thailand.min.js
cp ./jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css ./libraries/jquery.Thailand.min.css