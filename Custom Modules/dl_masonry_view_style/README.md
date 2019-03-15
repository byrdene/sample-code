This is a customization of the sandbox project, Masonry View Style (https://www.drupal.org/project/masonry_view_style), and as the name suggests, creates a simple masonry views style.


Required jQuery plugins
-----------------------
Masonry (http://masonry.desandro.com/)
Imagesloaded (http://imagesloaded.desandro.com)


Initial Setup
-------------
1. Create a view and select __"DL Masonry View Style"__ as the format with __"Featured"__ as the view mode.
2. Edit the masonry options in __"dl-mvs.js"__ as needed.

Masonry options can be found at http://masonry.desandro.com/

In addition to the masonry options initialized for different views, there are classes added to the rows for the mosaic views on the _homepage_, _taxonomy term pages_, and _PAC page_. For example:

  * Content editors select mosaic options on the node edit form with different options available to
    different content types.
  * These choices produce classes that get applied to the twig files for the custom DS layout
    used in the "featured" view mode.
  * Based on the classes produced in these twig files, the appropriate parent classes are added to the
    views row in the file, "dl-mvs.js".
  * Note: Classes are necessary at both the views row and view mode levels in order to theme our beautiful but
    complicated design!


Theming
-------
Default styles exist in the module's css folder (__css/dl-mvs.css__) that create an initial 4-column responsive grid with gutters around the mosaic tiles or items.

However, the project's theme overrides these styles much of the time or customizes them further for different breakpoints.

