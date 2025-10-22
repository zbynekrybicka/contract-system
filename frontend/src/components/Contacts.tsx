import { useGetContactQuery } from '../services/api/contactApi';
import { useAppDispatch, useAppSelector } from '../hooks.ts';
import { isShownForm, showForm } from '../store/newContactFormSlice.ts';
import NewContact from './NewContact.tsx'

export default function Contacts() {
  const dispatch = useAppDispatch()
  const { data: contactList, isLoading: isContactListLoading } = useGetContactQuery({});
  const isShownNewContact = useAppSelector(isShownForm)

  return (
    <div>
      {isShownNewContact && <NewContact />}
      <h2><div className="inner-content">Contacts</div></h2>
      <div className="inner-content routes">
        <button className="button-new-contact" onClick={() => dispatch(showForm(true))}>New contact</button>
        <div className="contact-list">
          {isContactListLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" /> 
            : contactList?.map(contact => <div className="contact-list-item" key={contact.id} onClick={() => location.href = "/contacts/" + contact.id}>
            <div>{contact.firstName} {contact.middleName} {contact.lastName}</div>
            <div>{contact.dialNumber}{contact.phoneNumber}</div>
            <div>{contact.email}</div>
          </div>)}
        </div>
      </div>
    </div>
  );
}
