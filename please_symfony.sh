#! /bin/bash

SCRIPT_NAME=$(basename $0)

functionName() {
    if [ $# -eq 0 ]; then
        echo -e "${SCRIPT_NAME} ${FUNCNAME[0]} \e[33mparameterName\e[0m"
        exit 1
    fi
}

requireEasyAdmin() {
    composer require easycorp/easyadmin-bundle
}

makeEntity() {
    php bin/console make:entity
}

makeCrud() {
    php bin/console make:crud
}

makeAdminCrud() {
    php bin/console make:admin:crud
}

makeAdminDashboard() {
    php bin/console make:admin:dashboard
}

setupEasyAdmin() {
    requireEasyAdmin
    makeEntity
    makeAdminCrud
    makeAdminDashboard
}

serve() {
    symfony serve
}

serveDetached() {
    symfony serve -d
}

# Display the source code of this file
howItWorks() {
    cat $0
}

# List all functions that do not begin with an underscore _
_listAvailableFunctions() {
    cat $0 | grep -E '^[a-z]+[a-zA-Z0-9]*\(\) \{$' | sed 's#() {$##'
}

if [ $# -eq 0 ]; then
    _listAvailableFunctions
    exit
fi

$@
