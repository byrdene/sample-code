(function ($) {
  'use strict';

  Drupal.behaviors.dl_masonry_view_style = {
    attach: function (context, settings) {

      // PEOPLE VIEWS
      // init for responsive Masonry
      var $gridPeople = $('.view-people .dl-mvs-grid').masonry({
        itemSelector: '.dl-mvs-grid-item',
        columnWidth: '.grid-sizer', // actual size defined in css
        gutter: '.gutter-sizer', // actual size defined in css - delete if no gutter is desired
        horizontalOrder: true,
        percentPosition: true
      });
      // layout Masonry after each image loads
      $gridPeople.imagesLoaded().progress(function () {
        $gridPeople.masonry('layout');
        // reload on ajax update
        if (context !== document) {
          $gridPeople.masonry('reloadItems');
          $gridPeople.masonry('layout');
        }
      });

      // COMMITTEE VIEWS
      // init for responsive Masonry
      var $gridCommittee = $('.view-committee-lists .dl-mvs-grid').masonry({
        itemSelector: '.dl-mvs-grid-item',
        columnWidth: '.grid-sizer', // actual size defined in css
        gutter: '.gutter-sizer', // actual size defined in css - delete if no gutter is desired
        horizontalOrder: true,
        percentPosition: true
      });
      // layout Masonry after each image loads
      $gridCommittee.imagesLoaded().progress(function () {
        $gridCommittee.masonry('layout');
        // reload on ajax update
        if (context !== document) {
          $gridCommittee.masonry('reloadItems');
          $gridCommittee.masonry('layout');
        }
      });

      // TERM VIEWS
      // init for responsive Masonry
      var $gridTerms = $('.view-taxonomy-term .dl-mvs-grid').masonry({
        itemSelector: '.dl-mvs-grid-item',
        columnWidth: '.grid-sizer', // actual size defined in css
        gutter: '.gutter-sizer', // actual size defined in css - delete if no gutter is desired
        horizontalOrder: true,
        percentPosition: true
      });
      // layout Masonry after each image loads
      $gridTerms.imagesLoaded().progress(function () {
        $gridTerms.masonry('layout');
        // reload on ajax update
        if (context !== document) {
          $gridTerms.masonry('reloadItems');
          $gridTerms.masonry('layout');
        }
      });

      // PRINCETON ATHENS CENTER VIEW
      // init for responsive Masonry
      var $gridPAC = $('.view-princeton-athens-center .dl-mvs-grid').masonry({
        itemSelector: '.dl-mvs-grid-item',
        columnWidth: '.grid-sizer', // actual size defined in css
        gutter: '.gutter-sizer', // actual size defined in css - delete if no gutter is desired
        horizontalOrder: true,
        percentPosition: true
      });
      // layout Masonry after each image loads
      $gridPAC.imagesLoaded().progress(function () {
        $gridPAC.masonry('layout');
        // reload on ajax update
        if (context !== document) {
          $gridPAC.masonry('reloadItems');
          $gridPAC.masonry('layout');
        }
      });

      // HOMEPAGE
      var $gridHome = $('.view-homepage-mosaic .dl-mvs-grid').masonry({
        itemSelector: '.dl-mvs-grid-item',
        columnWidth: '.grid-sizer', // actual size defined in css
        gutter: '.gutter-sizer', // actual size defined in css - delete if no gutter is desired
        horizontalOrder: true,
        percentPosition: true
      });
      // layout Masonry after each image loads
      $gridHome.imagesLoaded().progress(function () {
        $gridHome.masonry('layout');
      });

      // For TERM, PAC, and HOMEPAGE Masonry views, classes are added to the views row
      // based on options the content editor has chosen on each node. These options are
      // reflected in the classes added to the view mode markup.

      // Although some default styles exist in this module, the many different display
      // choices for the mosaic tiles are styled in the project's theme.
      if (($('.view-homepage-mosaic').length > 0) ||
        ($('.view-taxonomy-term').length > 0) ||
        ($('.view-princeton-athens-center').length > 0)) {
        $('.node--type-page.group-one-row').parent().addClass('page-noimage-tile');
        $('.node--type-page:not(.group-one-row)').parent().addClass('page-tile');
        $('.node--type-person.white').parent().addClass('person-tile-white');
        $('.node--type-person.clear').parent().addClass('person-tile-clear');
        $('.node--type-person.image').parent().addClass('person-tile-image');
        $('.node--type-event.group-one-row').parent().addClass('event-noimage-tile');
        $('.node--type-event:not(.group-one-row)').parent().addClass('event-tile');
        $('.node--type-news').parent().addClass('news-tile-clear');
        $('.node--type-news.white').parent().addClass('news-tile-white');
        $('.node--type-news.clear').parent().addClass('news-tile-clear');
        $('.node--type-news.image').parent().addClass('news-tile-image');
        $('.node--type-opportunity.white').parent().addClass('opportunity-tile-white');
        $('.node--type-opportunity.clear').parent().addClass('opportunity-tile-clear');
        $('.node--type-opportunity.image').parent().addClass('opportunity-tile-image');
        $('.node--type-publication').parent().addClass('publication-tile');

      }

    }
  }
})(jQuery);
