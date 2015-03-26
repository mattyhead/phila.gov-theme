/**
 * Custom js for our theme
 *
 *
**/

new List('filter-list', {
    valueNames: ['item', 'item-desc']
});

var browse =
  {
    init : function()
      {
        jQuery(document).ready(function($) {
          /*
          * phila.gov/browse
          */
          var pathArray = window.location.pathname.split( '/' );

          var parentURL = pathArray[3];
          var childURL = pathArray[4];

          var parentClass = $('.parent-topics li').hasClass(parentURL);
          var childClass = $('.parent-topics li').hasClass(childURL);
          var theParentClassName = '.' + pathArray[2];
          var theChildClassName = '.' + pathArray[3];

          if (pathArray.length == 3){
              $('.browse nav ul').remove();
              $('#topic').removeClass('large-16');
          }

          //compare the url with the classname - if the url reflects the classname, remove everything else

          var topicList = document.getElementById('topic').getElementsByTagName('li'),
              $parentTopicDescription = $('.parent-topics').find('.parent-description'),
              $childDescription = $('.child-description'),
              $currentParentLink = $('.parent.current-topic').find('a'),
              $topic = $('#topic');

              if (pathArray.length == 3){
                  $('.parent-topics', $topic).find('li.child').remove();
                  $parentChildDescription.remove();
              }else if (parentClass == parentURL) {
                  $('.parent-topics', $topic).find('li').not(theParentClassName).remove();
                  $parentTopicDescription.remove();
                  $childDescription.not(theParentClassName).remove();

                  $(theParentClassName).addClass('current-topic');
                  $currentParentLink.removeAttr('href');
                  $topic.removeClass('large-16');
                  $topic.addClass('large-16 subtopic-select');

                  $('.parent.current-topic').next().addClass("current-subtopic");

                  $(".subtopics").not(".current-subtopic").remove();

              }else if (childClass == childURL){
                  $('.parent-topics li', $topic ).not(theParentClassName).remove();
                  $parentTopicDescription.remove();
                  $(theParentClassName).addClass('current-topic');
                  $childDescription.not(theParentClassName).remove();
                  $(theParentClassName).addClass('current-topic');
                  $(theChildClassName).addClass('current');
                  $currentParentLink.addClass('back-to-topic');
                  $('.browse nav ul').remove();
                  $childDescription.remove();
              }//end else if

          var currentURL = window.location.pathname;

          if (currentURL.indexOf('browse') != -1){
              var mq = window.matchMedia('(max-width: 48em)');

              if (mq.matches) {
                  var target = $('#topic li.current-topic');
                  $('html, body').animate({
                      scrollTop: target.offset().top
                  }, 1000);
              }
          }
      });
    }
  }

  jQuery(document).ready(function($) {
    //variable footer height for sticky footer
      var footerHeight = $("footer").height();
      $("#page").css("padding-bottom", footerHeight);
      $("#application").css("padding-bottom", footerHeight);
      $("footer").css("margin-top", -footerHeight);

    });

function searchPhilaGov(){
    var input = document.getElementById('search-form');
    var value = input ? input.value : 'defaultText';

   window.location.href = 'https://www.google.com/#q=site:phila.gov+' + escape(value);
}
