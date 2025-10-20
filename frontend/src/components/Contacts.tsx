import { useGetContactQuery, usePostContactMutation } from '../services/api/contactApi';

export default function Contacts(){
  const [createContact, { isLoading, error }] = usePostContactMutation();

  const { data } = useGetContactQuery({ q: "Jiří" });

  return (
    <div>
      <h2>
        <div className="inner-content">Contacts</div>
      </h2>
      <div className="inner-content routes">
        <br/>
        {!isLoading && <button onClick={() => createContact({name: 'New', email: 'new@example.com' })}>+ Add</button>}
        <ul style={{backgroundColor:"#FFF", padding: '25px'}}>{data?.map(c => <li key={c.id}>{c.name} — {c.email}</li>)}</ul>
        {JSON.stringify(error)}
      </div>
    </div>
  );
}
