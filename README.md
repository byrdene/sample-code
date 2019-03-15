# Code Samples

* Sample Technical Specification
* Custom Modules
* Live Sites

## Sample Technical Specification


I have written the tech specs for the last five projects on which I was the senior/lead developer. This has required a deep familiarity with the wireframes and designs and that I work closely with the client and team members to holistically understand the project requirements for both content admins and end users.

The sample tech spec I have included was for a recent Drupal 8 site for Princeton University (__"Princeton Politics Tech Specs.pdf"__).

## Custom Modules

Every Drupal site I have built has required I create custom modules to solve problems and to implement complicated designs. 

1.  The module, __"project_toolbox"__, includes a sample of hooks and functions mainly used to alter or improve the content authoring experience. 
1.  The module, __"project_ds_code_fields"__, contains a sample of custom Display Suite plugins used to render field data to meet design requirements. These plugins have been useful tools when preprocess hooks and twig customizations have not provided the same ease of use or flexibility in altering, combining, or displaying field data differently per content type and view mode.
1.  The module, __"dl_masonry_view_style"__, is a customization of the contrib sandbox project, masonry_view_style, and was developed to create the many different mosaic views on our Drupal 8 site for the Hellenic Studies program at Princeton University. The mosaic on the homepage was particularly complicated to implement. The client wanted different design options available per content type with the ability to select which nodes appear in the mosaic along with which of the design options get applied to each node. As such, this module works in conjunction with custom Display Suite layouts and twig files which are located in the project theme and not included here. The __README__ file in the module has some additional developer's notes for how the module works.

## Live Sites

The following is a list of recent projects on which I was the senior/lead developer. Unless otherwise noted, I did all of the site building and theming on these sites. Most of these projects include Solr integration, complex custom content migrations, custom feeds, and/or integration with jQuery plugins and libraries to implement features like Highcharts, maps, and mosaics:

__Drupal 8__

* https://hellenic.princeton.edu/ 
* https://politics.princeton.edu/
* https://www.nefa.org/*

__Drupal 7__

* https://sipa.columbia.edu/
* https://www.careereducation.columbia.edu/


*_I did everything on this project except for the Salesforce integration which was handled by my colleague who had programmed the original integration in the Drupal 7 version of the site._