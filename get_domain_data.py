#!/usr/bin/env python3
import sys
from whois import whois #python-whois installed and port 43 open

def dedupe_consecutive_lines(text: str) -> str:
    lines = text.splitlines()
    out = []
    prev = None
    for line in lines:
        if line != prev:
            out.append(line)
        prev = line
    return "\n".join(out)

def main():
    domain = sys.argv[1] if len(sys.argv) > 1 else ""
    if not domain:
        sys.exit(0)

    try:
        w = whois(domain)

        raw_text = dedupe_consecutive_lines(w.text or "")
        print(raw_text)
        print("\n------------------------------------\n")
        parsed_text = dedupe_consecutive_lines(str(w))
        print(parsed_text)

    except Exception as e:
        print(f"ERROR: {e}", file=sys.stderr)
        sys.exit(1)
        
if __name__ == "__main__":
    main()