import { useAppDispatch, useAppSelector } from '../hooks';
import { usePostContactMutation } from '../services/api/contactApi';
import { getFirstName, getMiddleName, getLastName, getDialNumber, getPhoneNumber, getEmail, 
    setFirstName, setMiddleName, setLastName, setDialNumber, setPhoneNumber, setEmail, showForm } from '../store/newContactFormSlice';

export default function NewContact() {
  const dispatch = useAppDispatch()
  const [ postContact, { isLoading } ] = usePostContactMutation()

  const firstName = useAppSelector(getFirstName)
  const middleName = useAppSelector(getMiddleName)
  const lastName = useAppSelector(getLastName)
  const dialNumber = useAppSelector(getDialNumber)
  const phoneNumber = useAppSelector(getPhoneNumber)
  const email = useAppSelector(getEmail)

  const handlePostContact = () => postContact({ firstName, middleName, lastName, dialNumber, phoneNumber, email }).then(() => dispatch(showForm(false)))
  
  return (
    <div className="dialog-background">
      <div className="dialog new-contact">
          <div className="header">
            New Contact
            <button onClick={() => dispatch(showForm(false))}>X</button>
          </div>
          <label>
            First name
            <input type="text" name="firstName" defaultValue={firstName} onChange={e => dispatch(setFirstName(e.target.value))}/>
          </label>

          <label>
            Middle name
            <input type="text" name="middleName" defaultValue={middleName} onChange={e => dispatch(setMiddleName(e.target.value))} />
          </label>

          <label>
            Last name
            <input type="text" name="lastName" defaultValue={lastName} onChange={e => dispatch(setLastName(e.target.value))} />
          </label>

          <label>
            Phone number
            <div className="row">
            <select name="dialNumber" defaultValue={dialNumber} onChange={e => dispatch(setDialNumber(parseInt(e.target.value)))}>
                <option value={undefined}></option>
                <option value={420}>+420</option>
                <option value={421}>+421</option>
            </select>
            <input type="text" name="phoneNumber" defaultValue={phoneNumber} onChange={e => dispatch(setPhoneNumber(e.target.value))} style={{ width: "100%" }}/>
            </div>
          </label>
          <label>
            E-mail
            <input type="text" name="email" defaultValue={email} onChange={e => dispatch(setEmail(e.target.value))} />
          </label>
          <div className="footer">
            <button className="post-contact" onClick={handlePostContact}>
                {isLoading ? <img src={"/src/assets/tube-spinner.svg"} /> : "Add new contact"}
            </button>
          </div>
      </div>
    </div>
  )
}
