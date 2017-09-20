# interact
interact wordpress plugins

This repo is to store all the plugins used by the interact server which manages h5p content. Licenses for each of the included plugins should be listed within thier corresponding directory along with their code. The h5p repo at https://github.com/h5p/h5p-wordpress-plugin is setup as a submodule within the plugins directory. The wpcas plugin was copied right into the repo and not much is expected to change with it.

Example of how to update h5p WordPress plugin:
```
git checkout master
cd plugins/h5p
git pull
# Substitute latest tag that works with current WordPress instance.
#   at this point it is h5p v1.9.2 for WordPress v4.8.2
git checkout 1.9.2
cd ../../
git add .
git commit -m 'h5p 1.9.2'
git push
git checkout qual
git merge master
git push origin qual
# Deploy and perform qual testing.
git checkout prod
git merge qual
git push origin prod
```
