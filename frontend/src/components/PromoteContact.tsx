import type { JSX } from "react";
import type { Contact } from "../services/api/contactApi";
import { usePostUserMutation } from "../services/api/userApi";

interface Props 
{
  contact: Contact
  handleCloseForm: (show: boolean) => void
}


export default function PromoteContact({ contact, handleCloseForm }: Props): JSX.Element
{

    /**
     * Promote Contact to Member
     */
    const [ postUser, { isLoading } ] = usePostUserMutation();
    const handlePromote: () => void = () => 
    {
        const contactId: number = contact.id;
        postUser({ contactId }).then(() => handleCloseForm(false))
    }


    /**
     * Header for the promote contact dialog
     */
    const header: JSX.Element = <div className="header">Promote Contact to Member 
        <button className="close" onClick={() => handleCloseForm(false)}>X</button>
    </div>


    const body: JSX.Element = <p>Are you sure you want to promote {contact.firstName} {contact.lastName} to a member?</p>


    /**
     * Buttons to promote contact
     */
    const buttons: JSX.Element = <div className="footer">
        <button className="confirm-promote-contact" onClick={handlePromote} disabled={isLoading}>Yes, Promote</button>
        <button className="cancel-promote-contact" onClick={() => handleCloseForm(false)}>Cancel</button>
    </div>


    return <div className="dialog-background">
        <div className="dialog promote-contact-dialog">{header}{body}{buttons}</div>
    </div>
}