#!/usr/bin/env sh
set -eu

dist_dir="preview-dist"
app_build_dir="preview-app"

rm -rf "$dist_dir" "$app_build_dir"
mkdir -p "$dist_dir/demo"

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

cd ../app.immobiliermatrixfrance.fr
npm ci
npx vite build --config vite.preview.config.js
cd ../public_html

cp "$app_build_dir/preview.html" "$dist_dir/demo/index.html"
cp -R "$app_build_dir/assets" "$dist_dir/demo/assets"
cp -R "$app_build_dir/images" "$dist_dir/images"
rm -rf "$app_build_dir"

echo "Source-faithful client preview prepared in $dist_dir"
