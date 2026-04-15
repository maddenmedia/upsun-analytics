# Upsun analytics tools

Log helpers for [Upsun](https://upsun.com/) projects (formerly Platform.sh). They use the **Upsun CLI** (`upsun`).

This repository ([**maddenmedia/upsun-analytics**](https://github.com/maddenmedia/upsun-analytics)) is maintained by **Karsh Hagan Madden**. It is a fork of **[platformsh-analytics](https://github.com/pixelant/platformsh-analytics)** by [Pixelant](https://github.com/pixelant). Thank you to the original authors for the PHP and GoAccess log workflows.

## License

The project is licensed under the **GNU General Public License v2.0** — see [LICENSE](LICENSE). Modified files are noted in their headers and in [CHANGELOG.md](CHANGELOG.md).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for pull requests, licensing expectations, and how we maintain the changelog.

## Compatibility

The tools have been tested on macOS, but should run elsewhere too.

## Initial setup

### Install the Upsun CLI

Install the `upsun` CLI from [Upsun CLI installation](https://developer.upsun.com/cli/install).

Run `upsun login` and enter your credentials (or use `UPSUN_CLI_TOKEN` for automation).

### Install GoAccess

You should also install `goaccess` from
https://goaccess.io/download

## The tools

The tools download and process logs from your Upsun project via the CLI.

### `upsunPhpAnalyzer.php` 

Generates an HTML file with PHP analytics.

Execution: `php upsunPhpAnalyzer.php`

### `upsunGoAccess.php`

Generates an HTML file with HTTP analytics.

Execution: `php upsunGoAccess.php`
