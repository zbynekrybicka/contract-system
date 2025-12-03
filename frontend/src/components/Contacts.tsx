import { useGetContactQuery, type Contact } from '../services/api/contactApi';
import NewContact from './NewContact.tsx'
import { useState, type JSX } from 'react';
import SubordinateTree from './SubordinateTree.tsx';
import { getFilteredSalesmanId } from '../store/salesmanFilterSlice.ts';
import { useAppSelector } from '../hooks.ts';

export default function Contacts(): JSX.Element 
{
  const salesmanId = useAppSelector(getFilteredSalesmanId);
  const { data: contactList = [], isLoading: isContactListLoading } = useGetContactQuery(salesmanId!, { skip: salesmanId === null });
  // console.log(salesmanId)
  // console.log(isContactListLoading)


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

    return <div className="row active contact-list-item" key={id} onClick={() => location.href = "/contacts/" + id}>
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
        <SubordinateTree />
        <div className="white-box">
          <button className="button-new-contact" onClick={handleNewContact}>New contact</button>
        </div>
        <div className="white-box">
          <h3>Your contacts</h3>
          <div className="contact-list table">
            <div className="row header">
              <div className="table-label">Full name</div>
              <div className="table-label">Phone number</div>
              <div className="table-label">E-mail</div>
            </div>
            {isContactListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> : contactList?.map(contactItem)}
          </div>
        </div>
      </div>
    </div>
  );
}
