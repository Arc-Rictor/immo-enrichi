#!/usr/bin/env sh
set -eu

dist_dir="preview-dist"

rm -rf "$dist_dir"
mkdir -p "$dist_dir"

for file in \
    index.html \
    en.html \
    fr.html \
    styles.css \
    styles-new.css \
    main.js \
    favicon.ico \
    Immo-Erichi_Logo1.png \
    english.png \
    france.png \
    arrow-down.png \
    hero.png \
    cta.jpg \
    join.png \
    join_fr.png \
    imf-load.jpg
do
    cp "$file" "$dist_dir/$file"
done

echo "Static client preview prepared in $dist_dir"
