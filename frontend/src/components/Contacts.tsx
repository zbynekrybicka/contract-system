import { useGetContactQuery, type Contact } from '../services/api/contactApi';
import NewContact from './NewContact.tsx'
import { useState, type JSX } from 'react';

export default function Contacts() {

  /**
   * @var contactList Contact[]
   * @var isContactListLoading boolean
   */
  const { data: contactList, isLoading: isContactListLoading } = useGetContactQuery({});


  /**
   * Is Shown New Contact
   */
  const [isShownNewContact, setShowNewContact ] = useState<boolean>(false)

  /**
   * Show New Contact Form
   */
  const handleNewContact: () => void = () => setShowNewContact(true)


  /**
   * @param contact Contact
   * @returns JSX.Element
   */
  const contactItem: (contact: Contact) => JSX.Element = contact => {

    /**
     * ID
     * First Name
     * Middle Name
     * Last Name
     * Dial Number
     * Phone Number
     * Email
     */
    const id: number = contact.id
    const firstName: string = contact.firstName
    const middleName: string = contact.middleName
    const lastName: string = contact.lastName
    const dialNumber: number = contact.dialNumber
    const phoneNumber: string = contact.phoneNumber
    const email: string = contact.email

    return <div className="contact-list-item" key={id} onClick={() => location.href = "/contacts/" + id}>
      <div>{firstName} {middleName} {lastName}</div>
      <div>{dialNumber}{phoneNumber}</div>
      <div>{email}</div>
    </div>
  }

  return (
    <div>
      {isShownNewContact && <NewContact handleShowForm={setShowNewContact} />}
      <h2><div className="inner-content">Contacts</div></h2>
      <div className="inner-content routes">
        <button className="button-new-contact" onClick={handleNewContact}>New contact</button>
        <hr/>
        <div className="contact-list">{isContactListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : contactList?.map(contactItem)}</div>
      </div>
    </div>
  );
}
