#!/bin/sh

mv output /tmp/output/ 

git checkout master

php phpDocumentor.phar -d src

git checkout gh-pages

cd output

for i in `ls`
do
    mv ../$i /tmp/$i
    mv $i ../$i
done

cd -

git commit -a -m "Documentation Update"

git checkout master
