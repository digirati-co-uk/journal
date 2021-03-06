#!/usr/bin/env bash
. /opt/smoke.sh/smoke.sh

function from_manifest {
    cat build/rev-manifest.json | jq -r ".[\"${1}\"]"
}

bin/console --version --env=$ENVIRONMENT_NAME

smoke_url_ok $(hostname)/favicon.ico
smoke_url_ok $(hostname)/$(from_manifest assets/favicons/manifest.json)
smoke_url_ok $(hostname)/$(from_manifest assets/patterns/css/all.css)
smoke_url_ok $(hostname)/$(from_manifest assets/images/banners/magazine-1114x336@1.jpg)
smoke_url_ok $(hostname)/ping
    smoke_assert_body "pong"

if [ "$ENVIRONMENT_NAME" != "ci" ] && [ "$ENVIRONMENT_NAME" != "dev" ]
  then
    retry ./status_test.sh 2
    smoke_url_ok $(hostname)/
fi

smoke_report
