# port-scan
A CLI tool to:
- add, update, list, delete host adresses
- scan ports on the added hosts to show open and closed hosts like this
```bash
      localhost:
        8000: closed
        8080: closed
        5173: open
```

## Usage
It is still a work in progress so you use with caution:

Clone the repo, PHP 8.1 is required and run
```bash
    composer install
```

- Add a host
```bash
    ./port-scan hosts add localhost http://46.101.213.224
```

- List hosts
```bash
    ./port-scan hosts list
```

- Delete a host
```bash
    ./port-scan hosts delete localhost
```

- WIP: Scan a host
```bash
    ./port-scan scan ports=8080,8000,3000
```