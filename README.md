# Alert After

This plugin displays an alert if a page is not modified after some expiration
time.

## Usage

Include the following in a page. The expiration time takes a [relative php date
format](http://php.net/manual/en/datetime.formats.relative.php).

```
~~ALERTAFTER:<expiration time>~~
```

```
~~ALERTAFTER~~
```

The default time is three months.

### Examples

```
~~ALERTAFTER:+3 days~~
```

```
~~ALERTAFTER:+2 months~~
```
