import { useState, type ChangeEvent, type JSX } from 'react';
import { usePostContactMutation } from '../services/api/contactApi';

type Props = {
  handleShowForm: (show: boolean) => void
}

export default function NewContact({ handleShowForm }: Props): JSX.Element {

  /**
   * First Name
   * Middle Name
   * Last Name
   * Dial Number
   * Phone Number
   * Email
   */
  const [ firstName, setFirstName ] = useState("")
  const [ middleName, setMiddleName ] = useState("")
  const [ lastName, setLastName ] = useState("")
  const [ dialNumber, setDialNumber ] = useState(420)
  const [ phoneNumber, setPhoneNumber ] = useState("")
  const [ email, setEmail ] = useState("")


  /**
   * Set First Name
   * Set Middle Name
   * Set Last Name
   * Set Dial Number
   * Set Phone Number
   * Set Email
   */
  const handleSetFirstName: (event: ChangeEvent<HTMLInputElement>) => void = e => setFirstName(e.target.value)
  const handleSetMiddleName: (event: ChangeEvent<HTMLInputElement>) => void = e => setMiddleName(e.target.value)
  const handleSetLastName: (event: ChangeEvent<HTMLInputElement>) => void = e => setLastName(e.target.value)
  const handleSetDialNumber: (event: ChangeEvent<HTMLSelectElement>) => void = e => setDialNumber(parseInt(e.target.value))
  const handleSetPhoneNumber: (event: ChangeEvent<HTMLInputElement>) => void = e => setPhoneNumber(e.target.value)
  const handleSetEmail: (event: ChangeEvent<HTMLInputElement>) => void = e => setEmail(e.target.value)

  
  /**
   * Close Form
   */
  const handleCloseForm = () => handleShowForm(false)


  /**
   * POST /contact
   */
  const [ postContact, { isLoading } ] = usePostContactMutation()
  const handlePostContact = () => postContact({ 
    firstName, 
    middleName, 
    lastName, 
    dialNumber, 
    phoneNumber, 
    email 
  }).then(handleCloseForm)
  
  
  return (
    <div className="dialog-background">
      <div className="dialog new-contact">
          <div className="header">New Contact <button onClick={handleCloseForm}>X</button></div>
          <label>First name <input type="text" name="firstName" defaultValue={firstName} onChange={handleSetFirstName}/></label>
          <label>Middle name <input type="text" name="middleName" defaultValue={middleName} onChange={handleSetMiddleName} /></label>
          <label>Last name <input type="text" name="lastName" defaultValue={lastName} onChange={handleSetLastName} /></label>

          <label>
            Phone number
            <div className="row">
            <select name="dialNumber" defaultValue={dialNumber} onChange={handleSetDialNumber}>
                <option value={undefined}></option>
                <option value={420}>+420</option>
                <option value={421}>+421</option>
            </select>
            <input type="text" name="phoneNumber" defaultValue={phoneNumber} onChange={handleSetPhoneNumber} style={{ width: "100%" }}/>
            </div>
          </label>

          <label>E-mail <input type="text" name="email" defaultValue={email} onChange={handleSetEmail} /></label>
          <div className="footer">
            <button className="post-contact" onClick={handlePostContact}>
                {isLoading ? <img src={"/src/assets/tube-spinner.svg"} /> : "Add new contact"}
            </button>
          </div>
      </div>
    </div>
  )
}
