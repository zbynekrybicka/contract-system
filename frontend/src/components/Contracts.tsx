import { useState, type JSX } from "react";
import { useGetContractQuery, type Contract } from "../services/api/contractApi";
import ContractDialog from './ContractDialog.tsx'

export default function Contracs(): JSX.Element 
{
    /**
     * Shown Contract Dialog
     */
    const [ shownContractDialog, setShownContractDialog ] = useState<Contract | null>(null)


    /**
     * Handle Close Contract Dialog
     */
    const handleCloseContractDialog = () => setShownContractDialog(null)


    /**
     * @var contractList Contact[]
     * @var isContractListLoading boolean
     */
    const { data: contractList, isLoading: isContractListLoading } = useGetContractQuery({});

    
    /**
     * Contract List Header
     */
    const contractListHeader: JSX.Element = <div className="row header">
        <div>Client</div>
        <div>Price</div>
        <div>Paid</div>
    </div>


    /**
     * Contract List Item
     * @param contract Contract
     * @returns JSX.Element
     */
    function contractListItem(contract: Contract): JSX.Element
    {
        /**
         * Contract ID
         * Client First Name
         * Client Middle Name
         * Client Last Name
         * Contract Price
         * Contract Paid
         */
        const contractId: number = contract.id
        const firstName: string = contract.client.firstName
        const middleName: string = contract.client.middleName
        const lastName: string = contract.client.lastName
        const price: number = contract.price
        const paid: string = contract.paid ? "YES" : "NO"


        /**
         * Handle Show Contract Dialog
         */
        const handleShowContractDialog = () => setShownContractDialog(contract)


        return <div className="row active" onClick={handleShowContractDialog} key={contractId}>
            <div>{firstName} {middleName} {lastName}</div>
            <div>{price}</div>
            <div>{paid}</div>
        </div>
    } 


    /**
     * Contract List Content
     */
    const contractListContent: JSX.Element[] = contractList?.map(contractListItem) || [<></>]


    return <div>
        <h2><div className="inner-content">Sales</div></h2>
        <div className="inner-content routes">
            <div className="white-box">
                <h3>Contract List</h3>
                {isContractListLoading || <div className="table">{contractListHeader}{contractListContent}</div>}
            </div>
        </div>
        {shownContractDialog && <ContractDialog contract={shownContractDialog} handleCloseForm={handleCloseContractDialog}/>}
    </div>
}
