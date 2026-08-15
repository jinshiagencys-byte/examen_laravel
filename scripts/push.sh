#!/usr/bin/env bash
set -euo pipefail

if [ "$#" -lt 1 ]; then
  echo "Erreur: veuillez fournir un message de commit." >&2
  echo "Usage: ./scripts/push.sh \"message de commit\"" >&2
  exit 1
fi

COMMIT_MESSAGE="$1"

git add -A
git commit -m "$COMMIT_MESSAGE"
git push
