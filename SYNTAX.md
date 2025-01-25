# Syntax Design Document

```
fn main() {
    
}
```

```
// Positional argument called `name` that accepts a string.
fn main(name: string) {

}
```

```
// Positional argument, followed by an option called `-m` or `--message` that accepts a string.
fn main(name: string, -m|--message: string) {

}
```

```
// Positional argument, followed by a flag called `-u` or `--uppercase` (defaults to `false` if not provided).
fn main(name: string, -u|--uppercase: bool) {

}
```

```
// Option that accepts multiple values that are strings.
fn main(-n|--name: string[]) {

}
```

```
// A subcommand that also supports the special arg/option parameter list. The script will automatically determine whether one of these subcommands is called or not, so no need to manually handle inside of `main`.
#[command]
fn example() {

}

fn main() {

}
```
