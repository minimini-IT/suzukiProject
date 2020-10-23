#!bin/bash

rm config/Seeds/*

cp text/SeedManagement/1_Elementary/* config/Seeds/
bin/cake migrations seed
rm config/Seeds/*

cp text/SeedManagement/2_ForeignKey/* config/Seeds/
bin/cake migrations seed
rm config/Seeds/*

cp text/SeedManagement/3_ForeignKey/* config/Seeds/
bin/cake migrations seed
rm config/Seeds/*

cp text/SeedManagement/4_ForeignKey/* config/Seeds/
bin/cake migrations seed
rm config/Seeds/*

exit 0
