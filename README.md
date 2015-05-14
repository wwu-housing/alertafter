# Alert After

This plugin displays an alert if a page is not modified after some expiration
time.

## Usage

Include the following in a page. The expiration time takes a [php date
format](http://php.net/manual/en/function.strtotime.php).

```
~~ALERTAFTER:<expiration time/date>~~
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

```
~~ALERTAFTER:May 3rd, 2015~~
```

