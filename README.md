# coma
Coma is a small PHP class for parsing CSV files and turning them into structured arrays.

## Usage

Using Coma is pretty damn simple, just add your CSV to the object when you create it, and then call the parse method.

```php
$array = (new Coma(file_get_contents('data.csv')))->parse();
```

Basically, if we had a CSV with the following:
```
Title 1,Title 2,Title 3,Title 4,Title 5
data 1,data 2,data 3,data 4,data 5
more data 1,more data 2,more data 3,more data 4,more data 5 
```
Coma will turn it into a nice array:
```
Array
(
    [0] => Array
        (
            [Title 1] => data 1
            [Title 2] => data 2
            [Title 3] => data 3
            [Title 4] => data 4
            [Title 5] => data 5
        )

    [1] => Array
        (
            [Title 1] => more data 1
            [Title 2] => more data 2
            [Title 3] => more data 3
            [Title 4] => more data 4
            [Title 5] => more data 5
        )

)
```

### Optional CSV Settings

If needed, you can optionally pass to Coma::__construct() some CSV settings, via array. The available settings are:

- **delimiter**: defaults to `','`;
- **eol**: defaults to `"\n"`.

Example passing different values via these settings:

```php
$array = (new Coma(
    file_get_contents('data.csv'),
    [
        'delimiter' => '|',
        'eol' => "\r\n",
    ])
)->parse();
```

## Support

If you have any issues with this, feel free to submit a pull request or make an issue.
