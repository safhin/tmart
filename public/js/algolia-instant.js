const searchClient = algoliasearch('ZI9EJSEXQF', '18283e853f4222614107a9a7dd37c0dd');

const search = instantsearch({
  indexName: 'products',
  searchClient,
});

search.addWidgets([
  instantsearch.widgets.hits({
    container: '#hits',
  })
]);
search.start();