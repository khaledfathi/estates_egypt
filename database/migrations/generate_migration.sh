#!/bin/bash

# This script generates multiple Laravel models and their corresponding
# migration files using a loop.
models=(
    "Transaction"
    "Estate"
    "EstateUtilityService"
    "EstateUtilityServiceInvoice"
    "Unit"
    "UnitUtilityService"
    "Owner"
    "OwnerPhone"
    "UnitOwnership"
    "Renter"
    "RenterPhone"
    "Contract"
    "ContractDocument"
    "RentInvoice"
    "SharedWaterInvoice"
)

for model in "${models[@]}"
do
    echo "Creating model and migration for: $model"
    ./artisan make:model --migration "$model"
    sleep 1
    echo "------------------------------------"
done

echo "All models and migrations have been created."
