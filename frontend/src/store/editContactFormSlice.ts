import { createSlice } from '@reduxjs/toolkit';
import type { Action, RootState } from '.';

export type EditContactFormData = {
    id: number;
    isShownForm: boolean;
    firstName: string;
    middleName: string;
    lastName: string;
    dialNumber: number;
    phoneNumber: string;
    email: string;
}

const slice = createSlice({
    name: "editContactForm",

    initialState: {
        id: 0,
        isShownForm: false,
        firstName: "",
        middleName: "",
        lastName: "",
        dialNumber: 420,
        phoneNumber: "",
        email: ""
    },

    reducers: {
        /**
         * 
         * 
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        hydrate: (state: EditContactFormData, action: Action<any>) => {
            state.id = action.payload.id
            state.firstName = action.payload.firstName
            state.middleName = action.payload.middleName
            state.lastName = action.payload.lastName
            state.dialNumber = action.payload.dialNumber
            state.phoneNumber = action.payload.phoneNumber
            state.email = action.payload.email
        },


        /**
         * 
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        showForm: (state: EditContactFormData, action: Action<boolean>) => {
            state.isShownForm = action.payload
        },


        /**
         * 
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setFirstName: (state: EditContactFormData, action: Action<string>) => {
            console.log(action.payload)
            state.firstName = action.payload
        },


        /**
         * 
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setMiddleName: (state: EditContactFormData, action: Action<string>) => {
            state.middleName = action.payload
        },


        /**
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setLastName: (state: EditContactFormData, action: Action<string>) => {
            state.lastName = action.payload
        },


        /**
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setDialNumber: (state: EditContactFormData, action: Action<number>) => {
            state.dialNumber = action.payload
        },


        /**
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setPhoneNumber: (state: EditContactFormData, action: Action<string>) => {
            state.phoneNumber = action.payload
        },


        /**
         * 
         * @param state EditContactFormData
         * @param action Action
         */
        setEmail: (state: EditContactFormData, action: Action<string>) => {
            state.email = action.payload
        },


        
    }
})


/**
 * Is Shown Form
 * 
 * @param state RootState
 * @returns boolean
 */
export const isShownForm = (state: RootState): boolean => state.editContactForm.isShownForm


/**
 * ID
 * 
 * @param state RootState
 * @returns string
 */
export const getId = (state: RootState): number => state.editContactForm.id


/**
 * First name
 * 
 * @param state RootState
 * @returns string
 */
export const getFirstName = (state: RootState): string => state.editContactForm.firstName


/**
 * Middle name
 * 
 * @param state RootState
 * @returns string
 */
export const getMiddleName = (state: RootState): string => state.editContactForm.middleName


/**
 * Last name
 * 
 * @param state RootState
 * @returns string
 */
export const getLastName = (state: RootState): string => state.editContactForm.lastName


/**
 * Dial number
 * 
 * @param state RootState
 * @returns number
 */
export const getDialNumber = (state: RootState): number => state.editContactForm.dialNumber


/**
 * Phone number
 * 
 * @param state RootState
 * @returns string
 */
export const getPhoneNumber = (state: RootState): string => state.editContactForm.phoneNumber


/**
 * Email
 * 
 * @param state RootState
 * @returns string
 */
export const getEmail = (state: RootState): string => state.editContactForm.email




export default slice.reducer
export const { hydrate, showForm, setFirstName, setMiddleName, setLastName, setDialNumber, setPhoneNumber, setEmail } = slice.actions