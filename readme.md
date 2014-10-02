# Structured Text

Structured Text provides a simple, extensible and transportable format for content.

```json
{
	blocks: {
		"type": ".paragraph",
		"text": "Hello world!",
		"annotations": [
			{
				"type": ".bold",
				"start": 6,
				"length": 5
			}
		]
	}
}
```

## Terminology

Block: Blocks are the main grouping elements of content, paragraphs as an example. Blocks may have associated child blocks and attributes. Blocks may also optionally provide a directly translated plain text representation of their content. This must only be available when the plain text content is directly related, the content of a paragraph for example. The text should not be provided for a table as the plain text representation is not directly known.

Annotations: Annotations are inline characteristics on a block.

Attributes: Attributes provide additional related information about a block or annotation.

Scope: A scope provides a default prefix for the type of all children blocks. A child block may opt into using the scope by prefixing its type with a period.

## Available Elements

The bocks available in the com.structured_text.core namespace are:

- paragraph
- list
- container (div?)
- image


The annotations available in the com.structured_text.core namespace are:

- link
- bold
- strong
- italic
- emphasis
- image
