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

# Vue templates reference images as '/images/x.png', but Vite rewrites absolute
# url() references in CSS against base '/demo/'. Publish both paths so the
# background images resolve whichever way they were authored.
cp -R "$app_build_dir/images" "$dist_dir/demo/images"

# Root-level public assets the app requests directly, e.g. the locale flags in
# LanguageSelector.vue ('/en.png', '/fr.png').
for asset in en.png fr.png favicon.png
do
    if [ -f "$app_build_dir/$asset" ]; then
        cp "$app_build_dir/$asset" "$dist_dir/$asset"
    fi
done

rm -rf "$app_build_dir"

echo "Source-faithful client preview prepared in $dist_dir"
