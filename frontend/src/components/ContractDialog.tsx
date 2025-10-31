import { useState, type ChangeEvent, type JSX } from "react";
import { usePutContractMutation, type Contract } from "../services/api/contractApi";

type Props = {
    contract: Contract
    handleCloseForm: () => void
}

export default function ContractDialog({ contract, handleCloseForm }: Props): JSX.Element
{
    /**
     * Client First Name
     * Client Middle Name
     * Client Last Name
     */
    const firstName: string = contract.client.firstName
    const middleName: string = contract.client.middleName
    const lastName: string = contract.client.lastName


    /**
     * Contract Price
     * Contract Paid
     */
    const [ price, setPrice ] = useState<number>(contract.price)
    const [ paid, setPaid ] = useState<boolean>(contract.paid)


    /**
     * Handle Set Price
     * Handle Set Paid
     */
    const handleSetPrice: (event: ChangeEvent<HTMLInputElement>) => void = (event) => setPrice(parseInt(event.target.value))
    const handleSetPaid: (event: ChangeEvent<HTMLInputElement>) => void = (event) => setPaid(event.target.checked)


    /**
     * PUT /contract
     * 
     * @param data Contract
     */
    const [ putMeeting, { isLoading }] = usePutContractMutation()
    function handleSaveContract() {
        putMeeting({
            id: contract.id,
            price,
            paid
        }).then(handleCloseForm)
    }


    /**
     * Dialog Header
     */
    const dialogHeader: JSX.Element = <div className="header">
        Contract Detail
        <button className="close" onClick={handleCloseForm}>X</button>
    </div>


    /*
     * Label Client
     */
    const labelClient: JSX.Element = <label>
        {firstName} {middleName} {lastName}
    </label>


    /**
     * Input Price
     */
    const inputPrice = <label>
        Price
        <input type="text" defaultValue={price} onChange={handleSetPrice} />
    </label>


    /**
     * Input Paid
     */
    const inputPaid = <label>
        <div className="row"><input type="checkbox" defaultChecked={paid} onChange={handleSetPaid} /> Paid</div>
    </label>


    /**
     * Button Save Meeting Result
     */
    const buttonSaveContract: JSX.Element = <button className="save-result" onClick={handleSaveContract}>Save Contract</button>


    return <div className="dialog-background">
        <div className="dialog">
            {dialogHeader}{labelClient}{inputPrice}{inputPaid}
            <div className="footer">{isLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : buttonSaveContract}</div>
        </div>
    </div>
}