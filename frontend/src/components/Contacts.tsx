// import { useGetContactsQuery } from '../services/api/contactsApi';
import { useAppDispatch, useAppSelector } from '../hooks.ts';
import { isShownForm, showForm } from '../store/newContactFormSlice.ts';
import NewContact from './NewContact.tsx'

export default function Contacts() {
  const dispatch = useAppDispatch()
  // const { data } = useGetContactsQuery({});
  const isShownNewContact = useAppSelector(isShownForm)

  return (
    <div>
      {isShownNewContact && <NewContact />}
      <h2>Contacts</h2>
      <button className="button-new-contact" onClick={() => dispatch(showForm(true))}>New contact</button>
    </div>
  );
}
