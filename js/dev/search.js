(function ($) {

var resultTemplate = '<article><header class="search-entry-header"><h3 class="entry-title">';
resultTemplate += '<a href="{{&url}}" rel="bookmark">{{title}}</a></h3></header>';
resultTemplate += '<p class="entry-summary">{{&summary}}</p></article><hr>';

var customRenderer = function(documentType, item) {
  var view = {
    url: encodeURI(item.url),
    title: item.title,
    // Looks like maybe all results have an item.highlight.body or neither
    summary: item.highlight.body || (item.body.length > 300 ? item.body.substring(0, 300) + '...' : item.body)
  };
  return Mustache.render(resultTemplate, view);
};

var $resultCount = $('#result-count');

var customPostRenderFunction = function(data) {
  var totalResultCount = 0;
  var $resultContainer = this.getContext().resultContainer;
  var spellingSuggestion = null;

  if (data['info']) {
    $.each(data['info'], function(index, value) {
      totalResultCount += value['total_result_count'];
      if ( value['spelling_suggestion'] ) {
        spellingSuggestion = value['spelling_suggestion']['text'];
      }

    });
  }

  if (totalResultCount === 0) {
    $resultCount.text("No results found");
  } else {
    $resultCount.html("Found <b>" + totalResultCount + "</b> results");
  }

  if (spellingSuggestion !== null) {
    $resultContainer.append('<div class="st-spelling-suggestion">Did you mean <a href="#" data-hash="true" data-spelling-suggestion="' + spellingSuggestion + '">' + spellingSuggestion + '</a>?</div>');
  }
};

var $stSearchInput = $("#st-search-input");
$stSearchInput.swiftypeSearch({
  engineKey: SWIFTYPE_ENGINE, // Env var set in footer by php
  resultContainingElement: '#st-results-container',
  renderFunction: customRenderer,
  postRenderFunction: customPostRenderFunction
});

$("#search-form").submit(function (e) {
  e.preventDefault();
  window.location.href = '/search#stq=' + $(this).find(".search-field").val();
});

function hashQuery () {
  // Fill search input with query from hash
  var params = $.deparam(location.hash.substr(1));
  $stSearchInput.val(params.stq);
}

// Fill search box on page load
hashQuery();

})(jQuery);