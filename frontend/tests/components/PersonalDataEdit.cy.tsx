import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import PersonalDataEdit from '../../src/components/PersonalDataEdit'


describe('PersonalDataEdit.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><PersonalDataEdit /></Provider>)
  })
})