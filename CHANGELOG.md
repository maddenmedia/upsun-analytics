# Changelog

All notable changes to this project are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/). Versioning uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

This fork is maintained at [**maddenmedia/upsun-analytics**](https://github.com/maddenmedia/upsun-analytics) (Karsh Hagan Madden). Upstream is [pixelant/platformsh-analytics](https://github.com/pixelant/platformsh-analytics).

## [Unreleased]

## [1.0.0] - 2026-04-14

First release of the Upsun-oriented fork (replacing the Platform.sh CLI with the Upsun CLI).

### Added

- `upsunPhpAnalyzer.php` — PHP access log analysis with HTML charts (Upsun CLI).
- `upsunGoAccess.php` — HTTP access logs piped through GoAccess (Upsun CLI).
- `CONTRIBUTING.md` — how to contribute, GPL expectations, and changelog/release notes.
- `platformPhpAnalyzer.php` and `platformGoAccess.php` retained alongside for comparison with upstream behavior.
- This changelog in [Keep a Changelog](https://keepachangelog.com/) form with **[Unreleased]** and versioned sections.

### Changed

- **CLI**: All former `platform …` usage is `upsun …` (`projects`, `project:info`, `environment:list`, `log`).
- **UX**: Upsun-style ASCII banner; prompts and lists say “Upsun” instead of “Platform.sh”.
- **CSV**: `str_getcsv(..., ',', '"', '\\')` for project/environment lists; space-separated log lines use `str_getcsv` with escape for quoted URIs.
- **PHP report**: Page title “Upsun PHP Analysis”; sizing block renamed to “Reference resource tiers” (`$referenceResourceTiers`) with Upsun-oriented wording.
- **GoAccess script**: `--environment` passed through `escapeshellarg()` for consistency with other CLI arguments.

### Fixed

- **Activity by hour**: Time-slot bucketing no longer double-advances the outer loop when `$hoursPerSlot > 1`; `$xLabels` built from bucket starts.
- **Charts**: Safer `max()` defaults on empty datasets; corrected `yAxisID` / `requestsAxis` on the Requests series (was `yAxeiID` / wrong id).
- **Top requests**: Replaced fragile min-key “top 10” logic with explicit sort-and-trim lists.
- **HTML capture**: `ini_set('display_errors', '0')` before buffered HTML output so notices do not corrupt the report.

### Removed

- Unused `ksortReverse()` helper from `upsunPhpAnalyzer.php` (superseded by the new top-requests implementation).

---

## Appendix: `platform*` vs `upsun*` (reference)

For a line-by-line migration view, compare the committed pairs:

| Upstream-style (Platform.sh CLI) | This fork (Upsun CLI) |
| --- | --- |
| `platformPhpAnalyzer.php` | `upsunPhpAnalyzer.php` |
| `platformGoAccess.php` | `upsunGoAccess.php` |

**Unchanged behavior** (both tools): interactive or argv-driven project/environment/line selection; optional local log file path for the PHP analyzer; `/typo3/` exclusion prompt; HTML output naming; `open` on macOS after the PHP report; GoAccess `COMBINED` format and bright theme.
