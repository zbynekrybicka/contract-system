import { useParams } from "react-router-dom"
import { useGetOneContactQuery } from "../services/api/contactApi"
import EditContact from "./EditContact.tsx";
import ContactHistory from "./ContactHistory"
import { useState, type JSX } from "react";

export default function ContactDetail(): JSX.Element {

  /**
   * Contact ID
   * Is Shown Edit Contact Form
   */
  const id = useParams().id || ""
  const [isShownEditContactForm, setShownEditContactForm ] = useState<boolean>(false)


  /**
   * Contact Detail
   * is Contact Detail Loading
   * First name
   * Middle name
   * Last name
   */
  const { data: contactDetail, isLoading: isContactDetailLoading } = useGetOneContactQuery(id)
  const firstName: string | undefined = contactDetail?.firstName
  const middleName: string | undefined = contactDetail?.middleName
  const lastName: string | undefined = contactDetail?.lastName

  /**
   * Handle Show Edit Contact Form
   */
  const handleShowEditContactForm: () => void = () => setShownEditContactForm(true)


  return (
    <div className="contact-detail">
      {isShownEditContactForm && <>{contactDetail && <EditContact contact={contactDetail} handleShowForm={setShownEditContactForm} />}</>}
      {isContactDetailLoading 
        ? <img src={"/src/assets/tube-spinner.svg"} height="100px" />
        : <>{contactDetail && <>
          <h2><div className="inner-content">{firstName} {middleName} {lastName}</div></h2>
          <div className="inner-content route">
            <button className="edit-contact" onClick={handleShowEditContactForm}>Edit contact</button><ContactHistory contact={contactDetail} />
          </div>
        </>}</>}
    </div>
  )
}
