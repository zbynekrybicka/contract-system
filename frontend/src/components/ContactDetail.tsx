import { useAppSelector, useAppDispatch } from "../hooks";
import { useParams } from "react-router-dom"
import { useGetOneContactQuery } from "../services/api/contactApi"
import { isShownForm, hydrate, showForm } from "../store/editContactFormSlice";
import EditContact from "./EditContact.tsx";
import { useEffect } from "react";

export default function ContactDetail() {
  const dispatch = useAppDispatch()
  const isShownEditContactForm = useAppSelector(isShownForm)

  const { id } = useParams()
  const { data: contactDetail, isLoading: isContactDetailLoading } = useGetOneContactQuery(id ? parseInt(id) : 0)

  useEffect(() => {
    // console.log("useEffect: [isContactDetailLoading]")
    if (!isContactDetailLoading && contactDetail) {
        // console.log("Call: hydrate")
        const { id, firstName, middleName, lastName, dialNumber, phoneNumber, email } = contactDetail
        const result = hydrate({ isShownForm: false, id, firstName, middleName, lastName, dialNumber, phoneNumber, email })
        // console.log(result)
        dispatch(result)
        // console.log("After call: hydrate")
    }
  }, [isContactDetailLoading, contactDetail, dispatch])

  return (
    <div className="contact-detail">
      {isShownEditContactForm && <EditContact />}
      {isContactDetailLoading ? <img src={"/src/assets/tube-spinner.svg"} height="50px" />
      : <div>
        <h2>
            <div className="inner-content">{contactDetail?.firstName} {contactDetail?.middleName} {contactDetail?.lastName}</div>
        </h2>
        <div className="inner-content route">
            <button className="edit-contact" onClick={() => dispatch(showForm(true))}>Edit contact</button>
        </div>
      </div>}
    </div>
  )
}
