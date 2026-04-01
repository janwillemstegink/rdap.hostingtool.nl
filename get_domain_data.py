#!/usr/bin/env python3
import sys
import json
from typing import Any

from whois import whois  # python-whois installed


def normalize_newlines(text: str) -> str:
    if not text:
        return ""
    return text.replace("\r\n", "\n").replace("\r", "\n")


def dedupe_consecutive_lines(text: str) -> str:
    lines = normalize_newlines(text).splitlines()
    out = []
    prev = None

    for line in lines:
        if line != prev:
            out.append(line)
        prev = line

    return "\n".join(out)


def text_to_html(text: str) -> str:
    if not text:
        return ""

    text = normalize_newlines(text)

    # escape HTML
    text = (
        text.replace("&", "&amp;")
            .replace("<", "&lt;")
            .replace(">", "&gt;")
    )

    return text.replace("\n", "<br>")


def normalize_value(value: Any) -> Any:
    if value is None:
        return None
    if isinstance(value, (str, int, float, bool)):
        return value
    if isinstance(value, list):
        return [normalize_value(v) for v in value]
    if isinstance(value, tuple):
        return [normalize_value(v) for v in value]
    if isinstance(value, dict):
        return {str(k): normalize_value(v) for k, v in value.items()}
    return str(value)


def clean_name_servers(value: Any):
    if not value:
        return []

    try:
        values = list(value) if not isinstance(value, str) else [value]
    except TypeError:
        values = [value]

    cleaned = []
    seen = set()

    for item in values:
        if item is None:
            continue

        s = str(item).strip()
        if not s:
            continue

        lower = s.lower()

        if lower in ("creation", "updated", "status", "dnssec"):
            continue

        if "." not in s:
            continue

        if lower not in seen:
            seen.add(lower)
            cleaned.append(s)

    return cleaned


def main():
    domain = sys.argv[1] if len(sys.argv) > 1 else ""
    if not domain:
        sys.exit(0)

    try:
        w = whois(domain)

        # RAW WHOIS
        raw_text = dedupe_consecutive_lines(getattr(w, "text", "") or "")
        print(text_to_html(raw_text))

        print("<br>------------------------------------<br>")

        # PARSED WHOIS (netter dan str(w))
        try:
            parsed = {k: normalize_value(v) for k, v in dict(w).items()}
        except Exception:
            parsed = {"parsed_error": "Could not parse WHOIS data"}

        if "name_servers" in parsed:
            parsed["name_servers"] = clean_name_servers(parsed["name_servers"])

        parsed_json = json.dumps(parsed, ensure_ascii=False, indent=2)
        print(text_to_html(parsed_json))

    except Exception as e:
        print(f"ERROR: {e}")
        sys.exit(1)


if __name__ == "__main__":
    main()