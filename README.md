# Matecat Language Tools

This library can be used to apply the correct language styling to a string.

## Supported languages

- ja-JP (Japanese)
- zh-TW (Traditional Chinese)

## Examples

Take a look at these few examples:

```php
$wrong = "商号は「株式会社」等を省略せず記載してください （例：株式会社XXX） 。";

$pipeline = new Pipeline("ja-JP");

// this will return the string with the correct language style
// 商号は「株式会社」等を省略せず記載してください（例：株式会社XXX）。
$correct = $pipeline->process($wrong); 
```
In case of non-supported language, the Pipeline will return the original string.

## Commands

If you have an application which uses [Symfony Console](https://github.com/symfony/console), you have some commands available:

*  ```mlt:process```    Process a string.

## Support

If you found an issue or had an idea please refer [to this section](https://github.com/mauretto78/language-tool/issues).

## Authors

* **Mauro Cassani** - [github](https://github.com/mauretto78)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


