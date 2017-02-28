# interact
interact wordpress plugins

This repo is to store all the plugins used by the interact server which manages h5p content. Licenses for each of the included plugins should be listed within thier corresponding directory along with their code.

Example of how to update:
```
# Sometimes h5p doesn't tag update so following will not work (a real shame):
# wget -P ~/Downloads/wordpress/ https://downloads.wordpress.org/plugin/h5p.1.7.12zip
# cd into interact repo plugins directory
wget -P ~/Downloads/wordpress/ https://downloads.wordpress.org/plugin/h5p.zip 
mv ~/Downloads/wordpress/h5p.zip ~/Downloads/wordpress/h5p.1.7.12.zip
rm -rf h5p
unzip ~/Downloads/wordpress/h5p.1.7.12.zip
grep 'Version:' h5p/h5p.php
git add .
git status
git commit -m 'h5p 1.7.12'
git tag -a v1.2 -m 'h5p 1.7.12'
git push
git push origin v1.2
# Do NOT forget to update interact's ansible plugin variable "wordpress_plugin_version: v1.2" to get the new changes.
```
