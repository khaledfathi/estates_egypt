<?php
declare(strict_types= 1);
namespace App\Shared\Infrastructure\Session\Constants;
 

final class SessionKeys {
    //for owners features  
    public const OWNER_EDIT_PREVIOUS_PAGE = 'owner_edit_last_page';
    public const OWNER_CURRENT_INDEX_PAGE = 'owner_current_index_page';
    // ----------------------
    //for renter features  
    public const RENTER_EDIT_PREVIOUS_PAGE = 'renter_edit_last_page';
    public const RENTER_CURRENT_INDEX_PAGE = 'renter_current_index_page';
    // ----------------------

    //for unit features  
    public const UNIT_EDIT_PREVIOUS_PAGE = 'unit_edit_last_page';
    public const UNIT_CURRENT_INDEX_PAGE = 'unit_current_index_page';
    // ----------------------

    //for estate document features  
    public const ESTATE_DOCUMENT_EDIT_PREVIOUS_PAGE = 'estate_document_edit_last_page';
    public const ESTATE_DOCUMENT_CURRENT_INDEX_PAGE = 'estate_document_current_index_page';
    // ----------------------

    //for estate utility service features  
    public const estate_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE = 'estate_utility_service_edit_last_page';
    public const estate_UTILITY_SERVICE_CURRENT_INDEX_PAGE = 'estate_utility_service_current_index_page';
    // ----------------------

    //for unit utility service features  
    public const UNIT_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE = 'unit_utility_service_edit_last_page';
    public const UNIT_UTILITY_SERVICE_CURRENT_INDEX_PAGE = 'unit_utility_service_current_index_page';
    // ----------------------

    //for owner group features  
    public const OWNER_GROUP_EDIT_PREVIOUS_PAGE = 'owner_group_edit_last_page';
    public const OWNER_GROUP_CURRENT_INDEX_PAGE = 'owner_group_current_index_page';
    // ----------------------

    //for unit contract features  
    public const UNIT_CONTRACT_EDIT_PREVIOUS_PAGE = 'unit_contract_edit_last_page';
    public const UNIT_CONTRACT_CURRENT_INDEX_PAGE = 'unit_contract_current_index_page';
    // ----------------------
}