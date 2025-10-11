import { useGetContactsQuery, useCreateContactMutation } from '../services/api/contactsApi';

export default function Contacts(){
  const [createContact, { isLoading, error }] = useCreateContactMutation();

  const { data } = useGetContactsQuery({ q: "Jiří" });

  return (
    <div>
      <h2>Contacts</h2>
      {!isLoading && <button onClick={() => createContact({name: 'New', email: 'new@example.com' })}>+ Add</button>}
      <ul>{data?.map(c => <li key={c.id}>{c.name} — {c.email}</li>)}</ul>
      {JSON.stringify(error)}
    </div>
  );
}
