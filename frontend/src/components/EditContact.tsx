import { useParams } from 'react-router-dom';
import { usePutContactMutation, type Contact } from '../services/api/contactApi';
import { useState, type ChangeEvent } from 'react';

type Props = {
  contact: Contact;
  handleShowForm: (show: boolean) => void;
}


export default function EditContact({ contact, handleShowForm }: Props) {
  
  /**
   * Contact ID
   */
  const id: number = parseInt(useParams().id  || "")


  /**
   * First Name
   * Middle Name
   * Last Name
   * Dial Number
   * Phone Number
   * Email
   */
  const [ firstName, setFirstName ] = useState<string>(contact.firstName)
  const [ middleName, setMiddleName ] = useState<string>(contact.middleName)
  const [ lastName, setLastName ] = useState<string>(contact.lastName)
  const [ dialNumber, setDialNumber ] = useState<number>(contact.dialNumber)
  const [ phoneNumber, setPhoneNumber ] = useState<string>(contact.phoneNumber)
  const [ email, setEmail ] = useState<string>(contact.email)


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
  const handleCloseForm: () => void = () => handleShowForm(false)
  

  /**
   * PUT /contact/:id
   */
  const [ putContact, { isLoading } ] = usePutContactMutation()
  const handlePuttContact = () => putContact([id, { 
    firstName, 
    middleName, 
    lastName, 
    dialNumber, 
    phoneNumber, 
    email
  }]).then(handleCloseForm)

  
  return (
    <div className="dialog-background">
      <div className="dialog edit-contact">
          <div className="header">Edit contact <button className="close" onClick={handleCloseForm}>X</button></div>
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
              <input type="text" name="phoneNumber" defaultValue={phoneNumber} onChange={handleSetPhoneNumber} 
                style={{ width: "100%" }}
              />
            </div>
          </label>

          <label>E-mail <input type="text" name="email" defaultValue={email} onChange={handleSetEmail} /></label>
          <div className="footer">
            <button className="put-contact" onClick={handlePuttContact}>{isLoading ? <img src={"/src/assets/tube-spinner.svg"} /> : "Save contact"}</button>
          </div>
      </div>
    </div>
  )
}
