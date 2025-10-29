import { useParams } from "react-router-dom"
import { useGetOneContactQuery } from "../services/api/contactApi"
import EditContact from "./EditContact.tsx";
import ContactHistory from "./ContactHistory"
import CallResult from "./CallResult"
import { useState, type JSX } from "react";

export default function ContactDetail(): JSX.Element {

  /**
   * Contact ID
   * Is Shown Edit Contact Form
   * Is Shown Call Result Form
   */
  const id = useParams().id || ""
  const [ isShownEditContactForm, setShownEditContactForm ] = useState<boolean>(false)
  const [ isShownCallResultForm, setShowCallResultForm ] = useState<boolean>(false)


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
   * Show Form New Call
   */
  const handleShowEditContactForm: () => void = () => setShownEditContactForm(true)
  const handleNewCall: () => void = () => setShowCallResultForm(true)


  return (
    <div className="contact-detail">
      {isShownEditContactForm && <>{contactDetail && <EditContact contact={contactDetail} handleShowForm={setShownEditContactForm} />}</>}
      {isShownCallResultForm && <CallResult handleShowForm={setShowCallResultForm} />}

      {isContactDetailLoading 
        ? <img src={"/src/assets/tube-spinner.svg"} height="100px" />
        : <>{contactDetail && <>
          <h2><div className="inner-content">{firstName} {middleName} {lastName}</div></h2>
          <div className="inner-content route">
            <div className="white-box">
              <button className="edit-contact" onClick={handleShowEditContactForm}>Edit contact</button>
              <button className="new-call" onClick={handleNewCall}>Call to contact</button>
            </div>
            <ContactHistory contact={contactDetail} />
          </div>
        </>}</>}
    </div>
  )
}
