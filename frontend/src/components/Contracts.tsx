import type { JSX } from "react";
import { useGetContractQuery, type Contract } from "../services/api/contractApi";

export default function Contracs(): JSX.Element 
{
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
         * Client First Name
         * Client Middle Name
         * Client Last Name
         * Contract Price
         * Contract Paid
         */
        const firstName: string = contract.client.firstName
        const middleName: string = contract.client.middleName
        const lastName: string = contract.client.lastName
        const price: number = contract.price
        const paid: string = contract.paid ? "YES" : "NO"


        return <div className="row active">
            <div>{firstName} {middleName} {lastName}</div>
            <div>{price}</div>
            <div>{paid}</div>
        </div>
    } 


    const contractListContent: JSX.Element[] = contractList?.map(contractListItem) || [<></>]


    return <div>
        <h2><div className="inner-content">Sales</div></h2>
        <div className="inner-content routes">
            <div className="white-box">
                <h3>Contract List</h3>
                {isContractListLoading || <div className="table">{contractListHeader}{contractListContent}</div>}
            </div>
        </div>
    </div>
}
