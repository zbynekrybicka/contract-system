import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import PersonalHistory from '../../src/components/PersonalHistory'


describe('PersonalHistory.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><PersonalHistory /></Provider>)
  })
})