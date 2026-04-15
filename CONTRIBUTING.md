# Contributing

Contributions are welcome. This repository is a **GPL v2** fork of [pixelant/platformsh-analytics](https://github.com/pixelant/platformsh-analytics); the same license applies to contributions you submit here.

## How to contribute

1. **Open an issue** to describe a bug or proposal, or **open a pull request** against [`maddenmedia/upsun-analytics`](https://github.com/maddenmedia/upsun-analytics) with a clear summary of the change.
2. **Keep the scope focused** — one logical change per PR when possible.
3. **Match existing style** in the PHP scripts (formatting, naming, structure) unless you are deliberately standardizing something across the file.

## License and attribution

- By contributing, you agree your work is licensed under **GNU General Public License v2.0 or later**, the same as this project.
- **Upstream**: Preserve credit to Pixelant / [platformsh-analytics](https://github.com/pixelant/platformsh-analytics) where the code derives from it; new files should state their relationship in a short header if they replace or extend upstream behavior.
- **This fork**: For substantive edits to `upsun*.php`, update the file header’s modification note (date and brief description) and add a [CHANGELOG](CHANGELOG.md) entry under **`[Unreleased]`**.

## Changelog

- Add a bullet under **`## [Unreleased]`** in [CHANGELOG.md](CHANGELOG.md) following [Keep a Changelog](https://keepachangelog.com/) sections (`Added`, `Changed`, `Fixed`, `Removed`, etc.).
- Maintainers move **`[Unreleased]`** into a dated version section when cutting a release.

## Releases

Version bumps follow [Semantic Versioning](https://semver.org/). Tag releases in Git when publishing; the changelog should list what shipped in that tag.
