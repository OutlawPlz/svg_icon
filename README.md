# SVG Icon

Custom config entity representing an SVG sprite.

## Quick Start

Start usign SVG Icon in three steps.

1. Download latest SVG Icon module from [Github][007e628a] or via Composer and
enable it as usual.
  ```sh
  composer require outlawplz/svg_icon
  ```

2. Create an SVG sprite file using services like [Icomoon][ab7bbc6f] or
[Flaticon][53702462].

3. In **Configuration > SVG Icon** upload your SVG sprite.

That's it. You're all set to start using SVG Icon.

  [007e628a]: https://github.com/OutlawPlz/svg_icon "Github - SVG Icon"
  [ab7bbc6f]: https://icomoon.io/ "Icomoon"
  [53702462]: http://www.flaticon.com/ "Flaticon"

## Third party modules

The module defines a config entity representing an SVG Sprite. You need a third
party module that uses this entity to print icons on front end. The module
comes with a sub-module called `svg_icon_menu_link` that let you print an SVG
icon in a menu link. Check it out!
