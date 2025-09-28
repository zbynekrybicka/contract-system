import { useGetContactsQuery, useCreateContactMutation } from '../features/contacts/contactsApi';
export default function Contacts(){
  const { data } = useGetContactsQuery({});
  const [createContact] = useCreateContactMutation();
  return (
    <div>
      <h2>Contacts</h2>
      <button onClick={()=>createContact({name:'New', email:'new@example.com'})}>+ Add</button>
      <ul>{data?.map(c=> <li key={c.id}>{c.name} — {c.email}</li>)}</ul>
    </div>
  );
}
