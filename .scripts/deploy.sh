
#!/usr/bin/env bash

set -Eeuo pipefail

APP_DIR="/var/www/filmycart.in/public_html"
BRANCH="dev"
PHP_BIN="/usr/bin/php"
COMPOSER_BIN="/usr/local/bin/composer"

cd "$APP_DIR"

echo "===================================="
echo "Starting Laravel deployment"
echo "Branch: $BRANCH"
echo "Directory: $APP_DIR"
echo "===================================="

# Ensure the working directory is a Git repository
if [ ! -d ".git" ]; then
    echo "ERROR: Git repository not found in $APP_DIR"
    exit 1
fi

# Fetch and deploy the latest code
echo "Fetching latest code..."
git fetch origin "$BRANCH"

echo "Checking for local changes..."
if ! git diff --quiet || ! git diff --cached --quiet; then
    echo "ERROR: Tracked local changes detected."
    echo "Commit, stash, or safely resolve these changes before deploying."
    exit 1
fi

if [ -n "$(git ls-files --others --exclude-standard)" ]; then
    echo "WARNING: Untracked files detected."
    git ls-files --others --exclude-standard
    echo "Review these files before deployment."
    exit 1
fi

echo "Deploying latest commit..."
git checkout "$BRANCH"
git pull --ff-only origin "$BRANCH"
