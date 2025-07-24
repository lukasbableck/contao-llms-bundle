# contao-llms-bundle

This bundle allows you to generate a `llms.txt` file via the Contao backend to optimize your site for LLMs like ChatGPT, Claude, Gemini, ...  
After creating a llms.txt page, the content can be edited directly via the edit child elements button in the page tree.  
llms.txt pages do not use a layout, therefore they also do not have articles.

The content is added via normal content elements, which have to be prefixed with `llms_` to be available for selection.  
Content elements with `llms_` prefix are not available for selection on normal pages/articles/news etc.

For information on how your `llms.txt` file should be structured, please refer to [llmstxt.org](https://llmstxt.org/).